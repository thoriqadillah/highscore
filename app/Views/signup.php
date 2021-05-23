<style>
    *{
        
        font-family: 'Reggae One', cursive;
    }
    .container{
      border-color: #884141;
      padding: 10px;
      border-style: solid;
      border-radius: 20px;
      border-width: 5px;
      box-sizing: content-box;
      margin: 250px;
      margin-top: 100px;
    }
    .btn{
        background-color: #884141;
  border: none;
  color: #fff;
  padding: 30px;
  padding-top: 15px;
  padding-bottom: 15px;
  text-decoration: none;
  display: flex;
  position: absolute;
  font-size: 10px;
 margin-bottom: 0;
 position: relative;
 right: 0px;
  border-radius: 10%;
  font-size: 15px;
    }
.btn:hover {background-color: #492227}

.btn:active {
  background-color: #492227;

}
    
    </style>
    
    <div class="container" align="center">
    <h1>World's Rank Game Registration</h1>
    <form >
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="username" class="form-control" id="exampleInputEmail1" aria-describedby="usernameHelp">
        
      </div>
      <br> 
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="repeatpassword" class="form-control" id="exampleInputPassword1">
      </div>
      <br> 
      <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Repeat Password</label>
        <input type="repeatpassword" class="form-control" id="exampleInputPassword2">
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>
