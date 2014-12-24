<?php
/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

namespace Cribbb\Storage\User;

interface UserRepository {

    public function all();
    public function find($id);
    public function create($input);
    public function update($input);
    public function delete($id);

}