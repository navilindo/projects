<?php
    function call($ctrl, $action) {
        require_once('ctrls/' . $ctrl . 'Ctrl.php');

        switch($ctrl) {
            case 'pages':
                $ctrl = new PagesCtrl();
            break;
            
            case 'user':
                // we need the model to query the database later in the controller
                require_once('models/user.php');
                $ctrl = new UserCtrl();
            break;

        }

        $ctrl->{ $action }();
    }


    $controllers = array(
        'pages' => ['home', 'error','login_error','contact_us'],
                       
        'user' => ['index','add','added','view_all','search','search_result','view','delete','confirm','block','home','logout','edit','reset_pass','view_all_blocked','view_all_active','view_all_customers','view_all_admins','view_all_inactive','cats']
    );



    if (array_key_exists($ctrl, $controllers)) {
        if (in_array($action, $controllers[$ctrl])) {
            call($ctrl, $action);
        } else {
             //echo 'this is what has worked</br>';
            call('pages', 'error');
        }
    } else {
        //echo 'this had to work because it did not find file</br>';
        call('pages', 'error');
        //call('user','index'); // for testing
    }

?>