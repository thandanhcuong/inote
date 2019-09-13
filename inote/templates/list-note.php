
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">Danh sách các note</h3>
            <div class="list-group">
                <?php
                    // sql check not
                    $sql_check_note = "SELECT * FROM notes WHERE user_id = '$data_user[id_user]' ORDER BY id_note DESC ";

                    // neu co
                    if ($DB->num_nows($sql_check_note)){
                        // in danh sach ghi chu

                        foreach($DB->fetch_assoc($sql_check_note, 0) as $key => $data_list_note){

                            $date_created = $data_list_note['date_created'];
                            $day_created = substr($date_created, 8, 2); // Ngày tạo
                            $month_created = substr($date_created, 5, 2); // Tháng tạo
                            $year_created = substr($date_created, 0, 4); // Năm tạo
                            $hour_created = substr($date_created, 11, 2); // Giờ tạo
                            $min_created = substr($date_created, 14, 2); // Phút tạo



                            if (strlen($data_list_note['body']) > 300){
                                $data_list_note['body'] = substr($data_list_note['body'], 0, 300).'...';
                            }else{
                                $data_list_note['body'] = $data_list_note['body'];
                            }

                            echo '
                            <a href="index.php?ac=edit_note&&id='.$data_list_note['id_note'].'" class="list-group-item ">
                                <h4 class="list-group-item-heading">'.$data_list_note['title'].'</h4>
                                <p class="list-group-item-text">'.$data_list_note['body'].'</p>
                                <small> Tạo ngày
                                    '.$day_created.' tháng
                                    '.$month_created.' năm
                                    '.$year_created.' lúc
                                    '.$hour_created.':'.$min_created.'
                                </small>
                             </a>         
                        ';
                        }

                    }// khong co
                    else
                    {
                        // Hiển thị thông báo
                        echo '
                        <div class="alert alert-info">Hiện tại bạn chưa có note nào.</div>
                    ';
                    }

                ?>
            </div>
        </div>
    </div>
</div>
<?php

