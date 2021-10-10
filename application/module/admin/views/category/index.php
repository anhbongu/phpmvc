    
    <div id="content-box">
        <?php include_once(MODULE_PATH.'admin/views/toolbar.php'); ?>
        <?php include_once('submenu/index.php'); ?>
        <?php 


            $search         = isset($this->arrParam['filter_search']) ? $this->arrParam['filter_search'] : '';
            $columnPost     = isset($this->arrParam['filter_column']) ? $this->arrParam['filter_column'] : '';
            $orderPost      = isset($this->arrParam['filter_column']) ? $this->arrParam['filter_column_dir'] : '';  
            $lblUserName    = Helper::cmsLinkSort('Name', 'name', $columnPost, $orderPost); 
            $lblId          = Helper::cmsLinkSort('Id', 'id', $columnPost, $orderPost); 


            //SLECTBOX PUBLISH UNPUBLISH
            //status
            $checked        = isset($this->arrParam['filter_state']) ? $this->arrParam['filter_state'] : '2';
            $arrStatus      = array(2=>'-Select Status-', 1=>'Publish', 0=>'UnPublish');
            $statusSlectbox = Helper::cmsSelectBox('filter_state', $arrStatus, $checked);




            //PAGINATION
        
            $paginationHTML = $this->pagination->ShowPagination();
            


            $message        = SESSION::get('message');
            SESSION::delete('message');
            $alert          = Helper::cmsMessage($message);


         ?>
    
        <div id="system-message-container">
            <dl id="system-message">
                <?php echo $alert; ?>
            </dl>
        </div>
        
        <div id="element-box">
            <div class="m">
                <form action="#" method="post" name="adminForm" id="adminForm">
                    <!-- FILTER -->
                    <fieldset id="filter-bar">
                        <div class="filter-search fltlft">
                            <label class="filter-search-lbl" for="filter_search">Filter:</label>
                            <input type="text" name="filter_search" id="filter_search" value="<?php echo $search; ?>" title="Search in module title.">
                            <button type="submit" name="submit_keyword">Search</button>
                            <button type="button" name="clear_keyword">Clear</button>
                        </div>
                        <div class="filter-select fltrt">

                            <?php echo $statusSlectbox?>
        



                        </div>
                    </fieldset>
                    <div class="clr"> </div>

                    <table class="adminlist" id="modules-mgr">
                        <!-- HEADER TABLE -->
                        <thead>
                            <tr>
                                <th width="1%">
                                    <input type="checkbox" name="checkall-toggle" >
                                </th>
                                <th width="1%" class="nowrap"><?php echo $lblId; ?></th>
                                <th class="title"><?php echo $lblUserName; ?></th>

                                <th width="10%"><a href="#">Picture</a></th>
                                <th width="10%"><a href="#">Status</a></th>

                  
                                <th width="10%"><a href="#">Ordering</a></th>
                                <th width="10%"><a href="#">Created</a></th> <!-- thơi gian tạo -->
                                <th width="10%"><a href="#">Created by</a></th>             <!-- tạo bởi ai -->
                                <th width="10%"><a href="#">Modified</a></th>           <!-- thời gian chỉnh sữa -->
                                <th width="10%"><a href="#">Modified by</a></th>                <!-- thời gian chỉnh sữa -->
                                
                            </tr>
                        </thead>
                        <!-- FOOTER TABLE -->
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <!-- PAGINATION -->
                                    <div class="container">
                                        <div class="pagination">

                                            <?php 
                                                echo $paginationHTML;
                                             ?>
 
                                           
                                        </div>
                                        

                                    </div>              
                                </td>
                            </tr>
                        </tfoot>
                        <!-- BODY TABLE -->
                        <tbody>
   
                            <?php 
                                if(!empty($this->list)){
                                     $i = 0;
                                    foreach ($this->list as $key => $value) {
                                        $id = $value['id'];
                                        $ckbox = '<input type="checkbox" name="cid[]" value="'.$value['id'].'" >';


                                        $name = $value['name'];
                                        $linkPicture = FILES_URL.'category'.DS;

                                        $picture =  '<img src="'.$linkPicture.$value['picture'].'" style="width: 50%;">';
                                        $classRow = ($i%2==0) ? 'row0' : 'row1';
                         
          
                                        $status = Helper::cmsStatus($value['status'],URL::creatLink('admin', 'category','ajaxStatus', array('id'=>$id, 'status'=>$value['status']), 'js'),$id);
                               
                                        $ordering = '<input type="text" name="order['.$id.']" size="5" value="'.$value['ordering'].'"  class="text-area-order">';
                                        $created = Helper::fomatDate($value['created']);

                                        $createdBy = $value['created_by'];
                                        $modified = Helper::fomatDate($value['modified']);
                                        $modifiedBy = $value['modified_by'];
                                       
                                        $linkEdit = URL::creatLink('admin', 'category', 'edit', array('id'=>$id));
                                            ?>
                                                <tr class="<?php echo $classRow;  ?>">

                                                    <td class="center"><?php echo $ckbox; ?></td>
                                                    <td class="center"><?php echo $id; ?></td>
                                                    <td><a href="<?php echo $linkEdit;  ?>"><?php echo $name; ?></a></td>
                                
                                                 
                                                    <td class="center"><?php echo $picture; ?></td>
                                                    <td class="center"><?php echo $status; ?></td>
                                        
                                                    <td class="center"><?php echo $ordering; ?></td>
                                                    <td class="center"><?php echo $created; ?></td>
                                                    <td class="center"><?php echo $createdBy; ?></td>
                                                    <td class="center"><?php echo $modified; ?></td>
                                                    <td class="center"><?php echo $modifiedBy; ?></td>
                                                    
                                                </tr>  

                                            <?php
                                           $i++; 
                                    }
                                }
                             ?>                            
 
   
                        </tbody>
                    </table>

                    <div>
                        <input type="hidden" name="filter_column" value="name"> <!-- sắp xêp theo cột nào mặc định là xs theo name -->
                        <input type="hidden" name="filter_column_dir" value="DESC">   <!-- và giảm dần hay tăng dần mặc định là xs theo DSC -->
                        <input type="hidden" name="filter_page" value="1">   
                    </div>
                </form>

                <div class="clr"></div>
            </div>
        </div>

    </div>
       