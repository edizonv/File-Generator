<?php require_once 'inc/header.php'; ?>

<form action="file-checked.php" method="POST" enctype="multipart/form-data" class="col-md-4 col-md-offset-4">
	<legend><h2>File Generator</h2></legend>
	<dl>
    <dd><input type="hidden" name="root" value="root" required /></dd>
    <dt><label for="path">Project Path:</label></dt>
    <dd class="form-group"><input type="text" id="path" name="path" class="form-control" required data-toggle="tooltip" title="Paste the project path here." /></dd>
    <!-- <dt><label for="path">Save to :</label></dt> -->
    <dd><input type="hidden" id="newpath" name="newpath" value="<?php  echo getenv("HOMEDRIVE").getenv("HOMEPATH")."\Desktop\\".date("Ymd").'_files';  ?>" required /></dd>
    <dt><label for="path">From :</label></dt>
    <dd class="row form-group time">
      <div class="col-md-6"><input type="date" class="form-control" id="from-date" name="from-date" value="<?php echo date("Y-m-d"); ?>" /></div>
      <div class="col-md-3"><input type="number" class="form-control" id="hours" name="hours" value="00" /></div>
      <div class="col-md-3"><input type="number" class="form-control" id="minutes" name="minutes" value="00" /></div>
    </dd>
    <dt><label for="path">To :</label></dt>
    <dd class="form-group"><input type="date" id="to-date" name="to-date" class="form-control" value="<?php echo date("Y-m-d"); ?>" /></dd>
  </dl>
  <p class="text-right"><button name="submit-btn" class="btn btn-primary btn-lg">Generate Files</button></p>
  <ul>
    <li><a href="checker">Check Files</a></li>
    <!-- <li><a href="beta">Check images without alt</a></li> -->
  </ul>
  <div id="done"></div>
  <div id="result"></div>
</form>

<?php require_once 'inc/footer.php'; ?>