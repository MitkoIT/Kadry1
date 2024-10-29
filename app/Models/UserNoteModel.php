<?php

namespace App\Models;

use CodeIgniter\Model;

class UserNoteModel extends Model
{
    //protected $DBGroup = 'mitko';
    protected $table = 'user_note';

    protected $allowedFields = [ 
        'user_id',
        'note'
    ]; 

    public function getUserNote(int $id)
    {
        return $this->select('note')->where('user_id', $id)->first();
    }

}
