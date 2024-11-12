<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StripeController extends Controller
{
    public function createCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required'
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        $stripeCustomer = $user->createOrGetStripeCustomer();

        return response()->json([
            'success' => true,
            'stripe_customer_id' => $stripeCustomer->id,
        ], 201);
    }

    public function updateCustomer(Request $request, User $user)
    {
        // Tạo khách hàng trên Stripe nếu chưa tồn tại
        $user->createOrGetStripeCustomer();

        // Cập nhật thông tin khách hàng trên Stripe
        $user->updateStripeCustomer([
            // 'email' => $request->input('email', $user->email),
            'name' => $request->input('name', $user->name),
            'phone' => $request->input('phone', $user->phone),
            // Bạn có thể thêm các thuộc tính khác nếu cần
        ]);

        // Cập nhật thông tin trong hệ thống (nếu cần)
        $user->update($request->only(['name', 'phone']));

        return response()->json(['message' => 'Customer updated successfully']);
    }
}
