
@extends('client.layouts.app')
@section('title')
     Package Pricing
@endsection
@section('content') 
 <link href="{{asset('public/official/css/style.css')}}" rel="stylesheet">
<div class="about-bg page-hearder-area">
    <div class="official-overly"></div> 
  </div>   
  <style>
    #pricing{ padding:40px 0px; }
  </style>
  <style>
    
    .pricing-table {
      text-align: center;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-top: 50px;
    }
    .pricing-table h1 {
      font-size: 2em;
      margin-bottom: 20px;
    }
    .plan {
      display: inline-block;
      width: 250px;
      margin: 10px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      vertical-align: top;
    }
    .plan.top-sale {
      border: 2px solid #ffd700;
      background-color: #fff3cd;
    }
    .plan h2 {
      font-size: 1.5em;
      color: #333;
    }
    .plan .price {
      font-size: 1.2em;
      color: #e74c3c;
      margin: 10px 0;
    }
    .plan ul {
      list-style: none;
      padding: 0;
    }
    .plan ul li {
      margin: 10px 0;
      color: #666;
    }
    .plan .coins {
      color: #27ae60;
    }
    .plan .signup {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    .plan .signup:hover {
      background-color: #2980b9;
    }
  </style>
  <div class="pricing-table">
    <h1>Package Details</h1>
    <div class="plan">
    
      <div class="price">INR <i class="fa fa-rupee"></i> 1000</div>
      <ul>
        <li>Long time system login access</li>
        <li>Online system</li>
        <li>Full access</li>
        <li>Push Notification</li>
        <li>Roles & Permissions</li>
        <li class="coins">Coins(1111)Free First Time</li>
      </ul>

      <?php 	if(!Auth::guard('clients')->check()){ ?>
      <a href="{{ url('business-owners') }}" class="signup">Sign up now</a>
      <?php  }else{ ?>
      <a href="{{ url('business/package') }}" class="signup">Pay Now</a>
      <?php  } ?>
    </div>


    <div class="plan top-sale">
      
      <div class="price">INR<i class="fa fa-rupee"></i> 2000</div>
      <ul>
        <li>Long time system login access</li>
        <li>Online system</li>
        <li>Full access</li>
        <li>Push Notification</li>
        <li>Roles & Permissions</li>
        <li class="coins">Coins(2272)</li>
      </ul>
       <?php 	if(!Auth::guard('clients')->check()){ ?>
      <a href="{{ url('business-owners') }}" class="signup">Sign up now</a>
      <?php  }else{ ?>
      <a href="{{ url('business/package') }}" class="signup">Pay Now</a>
      <?php  } ?>
    </div>
    <div class="plan">
    
      <div class="price">INR<i class="fa fa-rupee"></i> 3000</div>
      <ul>
        <li>Unlimited Users Access</li>
        <li>Online system</li>
        <li>Full access</li>
        <li>Push Notification</li>
        <li>Roles & Permissions</li>
        <li class="coins">Coins(3529)</li>
      </ul>
       <?php 	if(!Auth::guard('clients')->check()){ ?>
      <a href="{{ url('business-owners') }}" class="signup">Sign up now</a>
      <?php  }else{ ?>
      <a href="{{ url('business/package') }}" class="signup">Pay Now</a>
      <?php  } ?>
    </div>
    <div class="plan">
     
      <div class="price">INR<i class="fa fa-rupee"></i> 5000</div>
      <ul>
        <li>Unlimited Users Access</li>
        <li>Online system</li>
        <li>Full access</li>
        <li>Push Notification</li>
        <li>Roles & Permissions</li>
        <li class="coins">Coins(6099)</li>
      </ul>
       <?php 	if(!Auth::guard('clients')->check()){ ?>
      <a href="{{ url('business-owners') }}" class="signup">Sign up now</a>
      <?php  }else{ ?>
      <a href="{{ url('business/package') }}" class="signup">Pay Now</a>
      <?php  } ?>
    </div>
    <div class="plan">
       
      <div class="price">INR<i class="fa fa-rupee"></i> 10000</div>
      <ul>
        <li>Unlimited Users Access</li>
        <li>Online system</li>
        <li>Full access</li>
        <li>Push Notification</li>
        <li>Roles & Permissions</li>
        <li class="coins">Coins(12500)</li>
      </ul>
       <?php 	if(!Auth::guard('clients')->check()){ ?>
      <a href="{{ url('business-owners') }}" class="signup">Sign up now</a>
      <?php  }else{ ?>
      <a href="{{ url('business/package') }}" class="signup">Pay Now</a>
      <?php  } ?>
    </div>
     


  </div>
  
 @endsection
