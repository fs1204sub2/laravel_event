<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function register()  // 登録のメソッド
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)]
                        // ハッシュ化する必要がある
          );

        session()->flash('message', '登録okです');
                        // key, value

        return to_route('livewire-test.index');
        // redirect()->route('名前付きルート') laravel8までは、という形だった。to_route('名前付きルート')と簡潔に書ける。
    }

    public function render()
    {
        return view('livewire.register');
    }
}
