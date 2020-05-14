<?php
/**
 *
 */
class AJaxController extends dFramework\core\Controller
{
    public function froalaloadimage()
    {
        exit(json_encode([
            'url' => site_url('avatars/default.png'),
            'thumb' => site_url('avatars/default.png'),
        ]));
    }
}
