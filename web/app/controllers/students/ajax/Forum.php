<?php
require_once __DIR__.'/../__StudentsController.php';

class Forum extends __StudentsController
{

    /**
     * Affiche le sommaire d'une matiere
     *
     * @author Dimitri
     * @param  int $id_matiere
     */
    public function _filter($id_filiere, $filtre)
    {
        $request = $this->api->post('billets_forum/read', null, [
            'id_filiere' => $id_filiere,
            'filtre' => $filtre
        ]);
        $data['billets'] = json_decode($request)->results ?? null;
        if(!empty($data['billets'])) {
            foreach ($data['billets'] As $key => $value) {
                $data['billets'][$key] = new BilletsEntity($value, $this->api);
            }
        }
        $this->view('/students/forum/ajax/filter', $data)->render();
    }
}
