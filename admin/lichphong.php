<?php // header
require_once 'include/header.php';

?>
<script>
    $(document).ready(function(){
        function view(){
            $(".view").on('click',function(e){
            e.preventDefault();
            var id = $(this).attr("data-id");
            
            $.ajax({
                url:"ajax/view.php",
                type:"GET",
                data:{id:id},
                success:function(string){
                    
                    $("#chi_tiet_phong").html(string);
                }
            })
        })
        }
        view()
        // Lọc
        function loc(){
            $("#loc").on('input',function(e){
            e.preventDefault();
            var phong = $(this).val();
            
            $.ajax({
                url:"ajax/loc.php",
                type:"GET",
                data:{phong:phong},
                success:function(string){
                    
                    $("#search").html(string);
                    view()
                }
            })
        })
        }
        loc()
    })

</script>

<div class="content">

    <!--LEFT-->
    <div class="row" class="container p-3" style="height: auto;">

        <div class="homeIntro bottomBorder" style=" text-align:Center;">
            <h1><b class="bigTitle">DANH SÁCH PHÒNG</b></h1>
            <!-- <form action="" method="GET">
                <div class="">
                    <input type="text" style="width:50%;margin-bottom:2%" placeholder="Nhập mã phòng hoặc phòng..."
                        id="timkiemphong">
                </div>
            </form> -->
            <div class="" style="margin: 20px;">
                <?php 
                     $sql = "SELECT id,phong FROM lichphong";
                     $res = mysqli_query($conn,$sql);
                     $danhsach = array();
                     if($res==true){
                        while($rows = mysqli_fetch_array($res)){
                            if(!in_array($rows['phong'],$danhsach)){
                                array_push($danhsach,$rows['phong']);
                            }
                        }
                     }
                ?>
                <select name="" id="loc" style="width:100px">
                    <option value=""></option>
                    <?php 
                        for($i=0;$i<count($danhsach);$i++){
                    ?>
                    <option value="<?php echo $danhsach[$i]; ?>"><?php echo $danhsach[$i]; ?></option>
                    <?php
                        }
                        
                        

                    ?>
                    
                    
                </select>
            </div>
            <div style="margin: 20px;">
                <table style="margin-left:2%;width:95%">
                    <col width="5%" />
                    <col width="10%" />
                    <col width="10%" />
                    <col width="15%" />
                    <col width="15%" />
                    <col width="15%" />
                    <col width="15%" />
                    <thead style="font-weight:bold">
                        <tr>
                            <th>STT</th>
                            <th>Thứ</th>
                            <th>Buổi</th>
                            <th>Số phòng</th>
                            <th>Số người hiện tại</th>
                            <th>Số người tối đa</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="search">
                        <?php
                        $sql = "SELECT lichphong.id,lichphong.phong,lichphong.thu,lichphong.buoi,lichphong.songuoihientai,lichphong.songuoitoida FROM lichphong  ";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            $i = 0;
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $i++;
                        ?>
                        <tr>
                            <td>
                                <b>
                                    <?php echo $i; ?>
                                </b>
                            </td>
                            <td>
                                <?php echo $rows['thu'] ?>
                            </td>
                            <td>
                                <?php echo $rows['buoi'] ?>
                            </td>
                            <td>
                                <?php echo $rows['phong'] ?>
                            </td>
                            <td>
                                <?php echo $rows['songuoihientai'] ?>
                            </td>
                            <td>
                                <?php echo $rows['songuoitoida'] ?>
                            </td>

                            <td>
                                <?php
                                if ($rows['songuoitoida'] - $rows['songuoihientai'] > 0) {
                                    echo "Trống";
                                } else {
                                    echo "Đủ";
                                }
                                ?>
                            </td>

                            <td>
                                <a style='font-size:1.1rem' data-id='<?php echo $rows['id'] ?>' data-toggle="modal" data-target="#myModal1" href="" class="view">View</a>
                            </td>

                        </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
                 <!-- The Modal -->
  <div class="modal fade" id="myModal1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Danh sách các sinh viên đăng ký</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Lớp</th>
            </tr>
            </thead>
            <tbody id="chi_tiet_phong">
                
            </tbody>
  </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>
                <hr>
            </div>
        </div>


        <?php
        require_once 'include/footer.php';
        ?>