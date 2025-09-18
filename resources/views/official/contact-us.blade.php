 
@extends('client.layouts.app')
@section('title')
     Contact us
@endsection
@section('content') 

<style>
       

        /* contact-header Styles */
        .contact-header {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #cacaca, #cacaca);
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            
        }

        .contact-header h1 {
            font-size: 2.8rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .contact-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

     

        .cnt-ck-scn {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        /* Contact Card Styles */
        .contact-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .contact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .contact-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #003366, #feb47b);
        }

        .contact-card .icon {
            width: 50px;
            height: 50px;
            background: #feb47b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .contact-card .icon img {
            width: 30px;
            height: 30px;
        }

        .contact-card h3 {
            font-size: 1.5rem;
            color: #1f2937;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .contact-card p {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #4b5563;
        }

        .contact-card a {
            color: #0C23FC;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .contact-card a:hover {
            color: #0C23FC;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-header h1 {
                font-size: 2.2rem;
            }

            .contact-header p {
                font-size: 1rem;
            }

            .cnt-ck-scn {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .contact-card {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .contact-header {
                padding: 40px 15px;
            }

            .contact-header h1 {
                font-size: 1.8rem;
            }

            .contact-card h3 {
                font-size: 1.3rem;
            }

            .contact-card p {
                font-size: 0.9rem;
            }
        }

           .contact-us{ margin-top: 70px; }
          .support {
            background: #acabab url('https://via.placeholder.com/1200x100') no-repeat;
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100px;
            margin-bottom: 25px;
        }
        .support {
            color: #fff;
        }
        .email {
            color: #fff;
            text-decoration: none;
        }
        .phone {
            color: #fff;
        }
        .button {
            background-color: #fff;
            color: #000;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
        }
        .button:hover {
            background-color: #e0e0e0;
        }
    </style>

<div class="contact-us">	
 <div class="contact-header">
        <h1>Contact Us</h1>
        <p>Reach out to our offices for any inquiries or support.</p>
    </div>
 <div class="support">
    <div>Customer Support India<br><i class="fa fa-envelope-o"></i> <a href="mailto:support@quickdials.com" class="email">support@quickdials.com</a></div>
    <div>Customer Support<br><i class="fa fa-mobile"></i> <span class="phone">70113 10265</span> </div>
    <!-- <div>For Advertisement Call<br><button class="button">Advertise Now</button></div> -->
</div>
<div class="container">
        <div class="cnt-ck-scn">
            <!-- Corporate Office -->
            <div class="contact-card">
                <div class="icon">
                    <img src="{{ asset('img/building.png')}}" alt="Building Icon">
                </div>
                <h3>Quick Dials Official</h3>
                <p>Bangalore (India)</p>
                <p><strong>Phone (India):</strong> <a href="tel:+917011310265">+91-70113 10265</a></p>
                <p><strong>WhatsApp:</strong> <a href="https://wa.me/917011310265">+91-70113 10265</a></p>
            </div>

            <!-- Head Branch -->
            <div class="contact-card">
                <div class="icon">
                    <img src="{{ asset('img/graduation-cap.png')}}" alt="Learning Icon">
                </div>
                <h3>Head Branch</h3>
                <p>Location:Bangalore<br>
                  <span>Pin Code:- 560002, India</span></p>
                <p><strong>Phone (India):</strong> <a href="tel:+917011310265">+91-70113 10265</a></p>
                <p><strong>WhatsApp:</strong> <a href="https://wa.me/917011310265">+91-70113 10265</a></p>
            </div>

        
            <div class="contact-card">
                <div class="icon">
                    <img src="{{ asset('img/globe.png')}}" alt="Globe Icon">
                </div>
                <h3>Branch -</h3>
                <p></p>
                <p><strong>Phone:</strong> <a href="tel:+917011310265">+917011310265</a></p>
                 
            </div>
 
        </div>
    </div>
<style>
    .help-block {
    display: block;
    margin-top: 0px !important;
    margin-bottom: 6px;
    color: #737373;
}
</style>
 
 
 <section class="map-cnt-ck">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="google-map">
							<strong>Reach to Us: </strong> 
							 
							
							<iframe style="width:100%;height:500px"
			frameborder="0" scrolling="no" style="border:0"
			src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAPFOcLOlCcBCtp764h9HflPfA56VlCFo0&q=delhi" allowfullscreen   width="520" height="275" frameborder="0" style="border:0;">
			</iframe>
						</div>
					</div>
					
					<div class="col-md-6 col-12">
						<div class="contact-query">
						 
							<div class="contact-query-heading">
								<h4>Let's Resolve Your Query</h4>
							</div>
							<div class="cnt-ck-form">
								  <div class="form contact-form">
              <div id="sendmessage"></div>
              <div id="errormessage"></div>
              <form action="" method="post" role="form" class="contactForm"  onsubmit="return homeController.saveEnquiryContact(this)">
                <div class="form-group">
			        	{{csrf_field()}}
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                 
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                 
                </div>
				<div class="form-group">
                  <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile" data-rule="mobile" data-msg="Please enter mobile" />
                
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter subject" />
                 
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                
                </div>
                 <div class="text-center"><button type="submit" class="btn btn-primary submit-btn-2">Send Message</button></div>
              </form>
            </div>
								 
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
 
</div>

 
    
 


 
 @endsection
