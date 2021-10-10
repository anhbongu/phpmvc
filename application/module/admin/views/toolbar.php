<?php 

           
    $controller     = $this->arrParam['controller']; 
    //add
    $linkNew        = URL::creatLink('admin', $controller, 'add', null, 'js');
    $btnNew         = Helper::cmsButton('toolbar-popup-new', $linkNew, 'icon-32-new', 'New');

    //publish
    $linkPublish    = URL::creatLink('admin', $controller, 'status', array('type' => '1'), 'js');
    $btnPublish     = Helper::cmsButton('toolbar-publish', $linkPublish, 'icon-32-publish', 'Publish', $type='submit');


    //unpublish
    $linkUnpublish  = URL::creatLink('admin', $controller, 'status', array('type' => '0'), 'js');
    $btnUnpublish   = Helper::cmsButton('toolbar-unpublish', $linkUnpublish, 'icon-32-unpublish', 'Unpublish', $type='submit');


    //trash
    $linkTrash      = URL::creatLink('admin', $controller, 'Trash',null, 'js');
    $btnTrash       = Helper::cmsButton('toolbar-trash', $linkTrash, 'icon-32-trash', 'Trash', $type='submit');

    //ORDERING
    $linkOrdering   = URL::creatLink('admin', $controller, 'ordering',null, 'js');
    $btnOrdering    = Helper::cmsButton('toolbar-checkin', $linkOrdering, 'icon-32-checkin', 'Ordering', $type='submit');


    //save
    $linkSave       = URL::creatLink('admin', $controller, 'add', array('type'=>'save'), 'js');
    $btnSave        = Helper::cmsButton('toolbar-apply', $linkSave, 'icon-32-apply', 'Save',  $type='submit');
    
    //save and close
    $linkSaveClose  = URL::creatLink('admin', $controller, 'add', array('type'=>'saveclose'), 'js');
    $btnSaveClose   = Helper::cmsButton('toolbar-save', $linkSaveClose, 'icon-32-save', 'Save and Close',  $type='submit');
    
    //save and new
    $linkSaveNew    = URL::creatLink('admin', $controller, 'add', array('type'=>'savenew'), 'js');
    $btnSaveNew     = Helper::cmsButton('toolbar-save-new', $linkSaveNew, 'icon-32-save-new', 'Save and new', $type='submit');

    //editsave
    $id             = isset($this->result['id']) ? $this->result['id'] : '';

    $linkEditsave   = URL::creatLink('admin', $controller, 'edit', array('id'=> $id), 'js');
    $btnEditsave     = Helper::cmsButton('toolbar-save-new', $linkEditsave, 'icon-32-apply', 'Update', $type='submit');
    //update profile
    $infoUser = SESSION::get('user');
    $linkProfile   = URL::creatLink('admin', $controller, 'profile', array('id'=> $infoUser['info']['id']), 'js');
    $btnProfile     = Helper::cmsButton('toolbar-save-new', $linkProfile, 'icon-32-apply', 'Update', $type='submit');

    


    
    //cancel
    $linkCancel     = URL::creatLink('admin', $controller, 'index');
    $btnCancel      = Helper::cmsButton('toolbar-cancel', $linkCancel, 'icon-32-cancel', 'Cancel');
    

    
    $action = $_GET['action'];
    switch ($action) {
        case 'index':
            $strButton = $btnNew.$btnPublish.$btnUnpublish.$btnTrash.$btnOrdering;
            break;
        case 'add':
            $strButton = $btnSave.$btnSaveClose.$btnSaveNew.$btnCancel;
            break;
        case 'edit':
            $strButton = $btnEditsave;
            break;        
        case 'profile':
            $strButton = $btnProfile.$btnCancel ;
            break;
        
      
    }

    
 ?>

<div id="toolbar-box">
            <div class="m">
                <!-- TOOLBAR -->
                <div class="toolbar-list" id="toolbar">
                    <ul>
                        <?php echo $strButton; ?>
                        
 



                 
                    </ul>
                    <div class="clr"></div>
                </div>
                <!-- TITLE -->

                <div class="pagetitle icon-48-module"><h2><?php echo $this->_titleName; ?></h2></div>
            </div>
        </div>