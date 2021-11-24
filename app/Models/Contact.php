<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'message'];

    const IS_UNREAD = 0;
    const IS_READ = 1;

    public static function add($fields)
    {
        $contact = new static;
        $contact->fill($fields);
        $contact->save();
        return $contact;
    }

    public function remove()
    {
        $this->delete();
    }

    public function read()
    {
        $this->status = Contact::IS_READ;
        $this->save();
    }

    public function unread()
    {
        $this->status = Contact::IS_UNREAD;
        $this->save();
    }

    public function toggleRead()
    {
        return ($this->status == Contact::IS_READ) ? $this->unread() : $this->read();
    }
}
