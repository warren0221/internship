<style>
	header{
  justify-content: space-between;
  background: #912c2c;
  padding: 0.2rem 35rem;
  position: fixed;
  left: 0px;
  top: 0;
  z-index: 100; 
  display: flex;
  align-items: center;
  text-decoration-color: black;
 
  box-shadow: 2px 2px 5px rgba(0,0,0.3);
}



</style>

<header>
 <img id="logo"src="../logo.png"width="50px" height="50px">
  <div class="container-fluid mt-2 mb-2">

    <div class="col-lg-12">

      <div class="col-md-1 float-left" style="display: flex;">
       
      </div>

      <div class="col-md-4 float-left text-white">
        
      </div>

      <div class="float-right">

        <div class=" dropdown mr-4">
            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="../ajax.php?action=logout"><i class="fa fa-power-off" id="logout"></i> Logout</a>
              </div>
        </div>
      </div>
  </div>
  
</header>

<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
  $('#logout').click(function(){
    status="Offline";
    })
</script>