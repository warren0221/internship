
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

#img{
  border-radius: 50%;

}
.float-right{
  margin-left: 600px;
  display: inline-block;
  align-items: center;
}

}
  }
</style>
<header>

	  	<div class="float-right">

        <div class=" dropdown mr-4">

            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?>  </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -5.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
              </div>
        </div>
      </div>
  
  
 </header>

<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_account.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>