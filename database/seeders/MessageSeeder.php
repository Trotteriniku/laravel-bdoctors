<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = config('db.messages');

        foreach ($messages as $message) {
            $newData = new Message();
            $newData->account_id = $message['account_id'];
            $newData->title = $message['title'];
            $newData->name = $message['name'];
            $newData->content = $message['content'];
            $newData->email = $message['email'];
            if (isset($message['created_at'])) {
                $newData->created_at = $message['created_at'];
            }
            $newData->save();
        }
    }
}
