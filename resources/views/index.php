<html>
<style>
html, body {
    min-height: 100vh;
}
header {background-color:grey;padding:1px;color:#fff;}
body { background-color: #f7f7f7; }
.apiContainer{
    padding:10px;
}
.row{
    display:flex; 
    justify-content:space-between;
    border: 1px solid grey;
}
.row *{
    padding:10px;
    }


</style>
    <body>
        <header><h3>Sandip Patil - Assignment - NewsApis</h3></header>
        <hr />
       <div class="apiContainer">
      <div class="row"><div>Method</div><div>URL</div> <div>Payload</div></div>
       <div class="row"><div>GET</div><div>/api/v1/news</div> 
       <div>?title=test <br /> &description=test<br /> &keywords=test,test1
       </div></div>
       </div>
        <footer><h6>version : <?php echo $version; ?></h6></footer>
    </body>
</html