<?php
class TestModel extends dFramework\core\Model
{

    function create()
    {
        $this->free_db()
            ->into('semestres', [
                'nom_semestre' => 'test',
                'abreviation' => 'T2',
                'statut_existant' => 1,
            ]);
    }
}
