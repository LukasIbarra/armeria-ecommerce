<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cartItems = $cart->items()->with(['product.mainImage'])->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        return view('web.cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Verificar stock
        if ($product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'No hay suficiente stock disponible.'
            ], 422);
        }

        $cart = $this->getOrCreateCart();

        // Verificar si el producto ya está en el carrito
        $existingItem = $cart->items()->where('product_id', $request->product_id)->first();

        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $request->quantity;

            if ($product->stock < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay suficiente stock disponible.'
                ], 422);
            }

            $existingItem->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $product->price,
            ]);
        }

        $cartCount = $cart->items()->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito.',
            'cart_count' => $cartCount
        ]);
    }

    public function update(Request $request, CartItem $cartItem)
    {
        // Verificar que el item pertenece al carrito del usuario
        if ($cartItem->cart->user_id !== Auth::id() && $cartItem->cart->session_id !== Session::getId()) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado.'
            ], 403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Verificar stock
        if ($cartItem->product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'No hay suficiente stock disponible.'
            ], 422);
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        $cart = $cartItem->cart;
        $cartItems = $cart->items()->with(['product.mainImage'])->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        return response()->json([
            'success' => true,
            'message' => 'Cantidad actualizada.',
            'item_total' => $cartItem->quantity * $cartItem->unit_price,
            'cart_total' => $total,
            'cart_count' => $cartItems->sum('quantity')
        ]);
    }

    public function destroy(CartItem $cartItem)
    {
        // Verificar que el item pertenece al carrito del usuario
        if ($cartItem->cart->user_id !== Auth::id() && $cartItem->cart->session_id !== Session::getId()) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado.'
            ], 403);
        }

        $cartItem->delete();

        $cart = $cartItem->cart;
        $cartItems = $cart->items()->with(['product.mainImage'])->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado del carrito.',
            'cart_total' => $total,
            'cart_count' => $cartItems->sum('quantity')
        ]);
    }

    public function clear()
    {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Carrito vaciado.',
            'cart_count' => 0
        ]);
    }

    private function getOrCreateCart()
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);
        } else {
            $cart = Cart::firstOrCreate([
                'session_id' => Session::getId(),
            ]);
        }

        return $cart;
    }
}
