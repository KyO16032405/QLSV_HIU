<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Kiểm tra xem user có thể xem danh sách user không.
     */
    public function viewAny(User $user): bool
    {
        return $user->level > 0; // Chỉ admin hoặc user có level > 0 mới có quyền xem danh sách
    }

    /**
     * Kiểm tra xem user có thể xem user cụ thể không.
     */
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->level > 0;
        // Admin hoặc chính chủ tài khoản mới có quyền xem
    }

    /**
     * Kiểm tra xem user có thể tạo user mới không.
     */
    public function create(User $user): bool
    {
        return $user->level > 0; // Chỉ admin (hoặc user có level cao hơn 0) có quyền tạo user
    }

    /**
     * Kiểm tra xem user có thể cập nhật thông tin user khác không.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->level > 0;
        // Admin hoặc chính chủ tài khoản mới có quyền chỉnh sửa
    }

    /**
     * Kiểm tra xem user có thể xoá user khác không.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->level > 0 && $user->id !== $model->id;
        // Admin có thể xóa user nhưng không thể tự xóa chính mình
    }

    /**
     * Kiểm tra xem user có thể khôi phục tài khoản đã bị xoá không.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->level > 0;
    }

    /**
     * Kiểm tra xem user có thể xóa vĩnh viễn user khác không.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->level > 0;
    }
}
