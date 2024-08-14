<!DOCTYPE html>
<html>
<head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>
<div class="container">
<br/>
<?php echo $this->session->flashdata('msg');?>
        <h2>Setup Database</h2>
                <a href="<?php echo base_url().'index.php/setup/create_table_user'?>" class="btn btn-success">Create Table User</a><br>
                <a href="<?php echo base_url().'index.php/setup/create_table_blog'?>" class="btn btn-success">Create Table Blog</a>
</div>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
</body>
</html>