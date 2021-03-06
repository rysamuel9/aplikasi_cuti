<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
 <?php
     include "session.php";
     ?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-minimized'			- Minimized Sidebar (Only icons)
5. '.sidebar-compact'			  - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'			- Fixed Breadcrumb

// Footer options
1. '.footer-fixed'					- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
   
   <?php include "header.php"; ?>

    <div class="app-body">
   <?php include "menu.php"; ?>

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="admin.php">Admin</a>
                </li>
            </ol>


            <div class="container-fluid">





                <div class="animated fadeIn">
                  <?php
             if(isset($_GET['hal']) == 'hapus'){
				$id = $_GET['kd'];
				$cek = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$id'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM user WHERE user_id='$id'");
					if($delete){
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
					}
				}
			}
			?>
            <div class="row">
                    
              <div class="col-lg-4">
              <form action='admin.php' method="POST">
          
	       <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan User ID dan Username' required /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='admin.php' class="btn btn-sm btn-success" >Refresh</i></a>
          	</div>
              </div>
                <br />
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Data</strong> Admin
                                </div>
                                <div class="card-body">
                                    <div class="text-left">
                  <a href="input-admin.php" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i> Input Data </a><br /><br />
              
                </div> 
                                      <?php
                    $query1="select * from user";
                    
                    if(isset($_POST['qcari'])){
	               $qcari=$_POST['qcari'];
	               $query1="SELECT * FROM  user 
	               where fullname like '%$qcari%'
	               or username like '%$qcari%'  ";
                    }
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>
                  <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>No </center></th>
                        <th><center>Username </center></th>
                        <th><center>Password </center></th>
                        <th><center>Fullname </center></th>
                        <th><center>Level </center></th>
                        <th><center>Tools</center></th>
                      </tr>
                  </thead>
                     <?php 
                     $no=0;
                     while($data=mysqli_fetch_array($tampil))
                    { $no++; ?>
                    <tbody>
                    <tr>
                    <td><center><?php echo $no; ?></center></td>
                    <td><center><?php echo $data['username'];?></center></td>
                    <td><center><?php echo $data['password'];?></center></td>
                    <td><center><?php echo $data['fullname'] ?></center></td>
                    <td><center>
                    <?php 
                            if($data['level'] == 'admin'){
								echo '<span class="badge badge-success">ADMIN</span>';
							}
                            else if ($data['level'] == 'superuser' ){
								echo '<span class="badge badge-primary">SUPERUSER</span>';
							}
                            else if ($data['level'] == 'user' ){
								echo '<span class="badge badge-info">USER</span>';
							}
                             ?>
                    </center></td>
                    <td><center><div id="thanks"><a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Edit Admin" href="edit-admin.php?hal=edit&kd=<?php echo $data['user_id'];?>"><span class="fa fa-pencil"></span></a>  
                        <a onclick="return confirm ('Yakin hapus <?php echo $data['fullname'];?>.?');" class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-toggle="tooltip" title="Hapus Admin" href="admin.php?hal=hapus&kd=<?php echo $data['user_id'];?>"><span class="fa fa-trash"></a></center></td></tr></div>
                       <?php   
              } 
              ?>
                   </tbody>
                   </table>
                  <!-- </div>-->
                                    
                                </div>
                               
                            </div>
                        </div>
                        
                        
                    </div>

            </div>
            <!-- /.conainer-fluid -->
        </main>
</div>

    </div>

    <?php  include "footer.php"; ?>

    <!-- Bootstrap and necessary plugins -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/tether.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/pace.min.js"></script>


    <!-- GenesisUI main scripts -->

    <script src="../js/app.js"></script>





    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
  <script src="../amcharts/amcharts.js"></script>
  <script src="../amcharts/serial.js"></script>
  <script src="../amcharts/dataloader.min.js"></script>
        <script>
  var chart = AmCharts.makeChart( "chartdiv", {
    "type": "serial",
    "dataLoader": {
      "url": "data.php"
    },
    "pathToImages": "http://www.amcharts.com/lib/images/",
    "categoryField": "category",
    "dataDateFormat": "YYYY-MM-DD",
    "startDuration": 1,
    "categoryAxis": {
      "parseDates": true
    },
    "graphs": [ {
      "valueField": "value1",
      "bullet": "round",
      "bulletBorderColor": "#FFFFFF",
      "bulletBorderThickness": 2,
      "lineThickness ": 2,
      "lineAlpha": 0.5
    }, {
      "valueField": "value2",
      "bullet": "round",
      "bulletBorderColor": "#FFFFFF",
      "bulletBorderThickness": 2,
      "lineThickness ": 2,
      "lineAlpha": 0.5
    } ]
  } );
  </script>

</body>

</html>