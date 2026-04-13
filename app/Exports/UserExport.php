<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        return User::where('role', $this->role)->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Password',
        ];
    }

    public function map($user): array
    {
        $defaultPassword = substr($user->email, 0, 4) . $user->id;

        if (Hash::check($defaultPassword, $user->password)) {
            $passwordText = $defaultPassword;
        } else {
            $passwordText = 'This account already edited the password';
        }

        return [
            $user->name,
            $user->email,
            $passwordText,
        ];
    }
}
