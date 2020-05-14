<?php
require __DIR__.DS.'__AdminController.php';

class SubjectController extends __AdminController
{
    /**
     * Gestion des ue
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('matieres/readAllInfo');
        $result = json_decode($result);
        
        $data['matieres'] = $result->results;

        $content = $this->view('/admin/education/subject/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/subject'),
            'content' => $content
        ]));
    }

    public function add()
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            
            $result = $this->api->post('matieres/create', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('ue/read');
        
        $result = json_decode($result);

        $data['ue'] = $result->results;

        $result = $this->api->post('matieres/read');
        $result = json_decode($result);

        $data['matieres'] = $result->results;

        $this->view('/admin/education/subject/create',$data)->render();
    }


    public function edit($id_subject)
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_matiere']=$id_subject;
            
            $result = $this->api->post('matieres/put', [], $data);

            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('matieres/readAllInfo', [], [
            'id_matiere' => $id_subject
        ]);
        $result = json_decode($result);
        $data['matieres'] = $result->results;

        $result = $this->api->post('ue/read');
        $result = json_decode($result);
        $data['ue'] = $result->results;
        $this->view('/admin/education/subject/edit',$data)->render();
    }

    public function delete()
    {
        $this->view('/admin/education/subject/delete')->render();
    }

    public function detail($id_subject)
    {
        $data['id_matiere']=$id_subject;

        $result = $this->api->post('matieres/readAllInfo', [], [
            'id_matiere' => $id_subject
        ]);
        $result = json_decode($result);
        $data['matieres'] = $result->results;


        $this->view('/admin/education/subject/detail',$data)->render();
    }
}