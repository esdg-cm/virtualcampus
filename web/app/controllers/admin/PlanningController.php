<?php
require __DIR__.DS.'__AdminController.php';

class PlanningController extends __AdminController
{
    /**
     * Gestion des planning
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $content = $this->view('/admin/education/planning/index')->get();

        exit(json_encode([
            'content' => $content
        ]));
    }

    public function add()
    {
        $result = $this->api->post('tranches_horaires/read');
        $result = json_decode($result);
        
        $data['tranches_horaires'] = $result->results;


        $result = $this->api->post('matieres/read');
        $result = json_decode($result);
        
        $data['matieres'] = $result->results;

        $result = $this->api->post('user/readTeacher');
        $result = json_decode($result);
        
        $data['teachers'] = $result->results;

        $this->view('/admin/education/planning/create',$data)->render();
    }


    public function edit()
    {
        $this->view('/admin/education/planning/edit')->render();
    }

    public function delete()
    {
        $this->view('/admin/education/planning/delete')->render();
    }
    public function hourly(){
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('tranches_horaires/read');
        $result = json_decode($result);

        $data['hourlies'] = $result->results;

        $content = $this->view('/admin/education/hourly/index',$data)->get();

        exit(json_encode([
            'content' => $content
        ]));
    }

}