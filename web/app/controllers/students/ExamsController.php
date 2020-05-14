<?php
require __DIR__.'/__StudentsController.php';
/**
 * Controlleur des examens de l'etudiant
 *
 * @author Dimitri Sitchet
 */
class ExamsController extends __StudentsController
{
    /**
     * Controles continus
     */
    public function cc()
    {
        $this->layout
            ->add('cc')
            ->launch();
    }

    /**
     * Controles continus
     */
    public function sn()
    {
        $this->layout
            ->add('sn')
            ->launch();
    }

    /**
     * Affichage de l'epreuve de composition
     */
    public function compose()
    {
        if($this->request->is('post')) {
            $datas = $this->request->data;
            var_dump($datas);
            exit;
        }

       $this->layout
            ->putLibCss('owlcarousel/owl.carousel.min', 'owlcarousel/owl.theme.default.min')
            ->putLibJs('owlcarousel/owl.carousel.min')
            ->putCss('students/compose')
            ->putJs('students/compose')
            ->add('compose')
            ->launch();
    }





    /**
     * Remappage des methodes (Redirection interne)
     *
     * @author  Dimitri Sitchet
     * @param  string $method Methode appelée
     * @param  array  $params Arguments passes en parametres
     */
    public function _remap($method, $params = [])
    {
        $params  = (array) $params;
        if(!preg_match('#^ajax#i', $method)) {
            if (method_exists($this, $method)) {
                return call_user_func_array([$this, $method], $params);
            }
            die('404 - Not found');
        }
        if (!$this->request->is('ajax')) {

            die('403 - Forbidden');
        }
        require_once __DIR__.'/ajax/Exams.php';

        $exams = new Exams;
        $method = str_replace('ajax', '', $method);
        $method = strtolower('_'.$method);

        if (!method_exists($exams, $method)) {
            die('404');
        }
        return call_user_func_array([$exams, $method], $params);
    }

}
