<footer id="colophon" class="site-footer" role="contentinfo">
      <div class="sm-row-fluid smue-row sme-dsbl-margin-left sme-dsbl-margin-right padding_row footer_row wow fadeInUp delay_26s" style="visibility: hidden; animation-name: none;">
        <div class="sm-span3 smue-clmn  sme-dsbl-margin-left sme-dsbl-margin-right">
          <div class="smue-text-obj footer_txt">
            <h3><span style="color: #ffffff;"><span style="color: #000000;">Find us</span><br>
              </span></h3>
            <p>&nbsp;</p>
            <p>{{$contacts->address}}</p>
            <!-- <p>augue sem viverra 10870</p>
            <p>id ultricies sapien.<span style="color: #c0c0c0;"><br>
              </span></p> -->
          </div>
        </div>
        <div class="sm-span3 smue-clmn  sme-dsbl-margin-left sme-dsbl-margin-right">
          <div class="smue-text-obj footer_txt">
            <h3><span style="color: #000000;">Reservation</span></h3>
            <p>&nbsp;</p>
            <p>{{$contact->contact}}<br>
              {{$contacts->email}}<br>
              {{$contacts->viber}}</p>
          </div>
        </div>
        <div class="sm-span4 smue-clmn  sme-dsbl-margin-left sme-dsbl-margin-right showcase_big_col showcase_col">
          <div class="smue-service-box-obj smue-service-box-centered smue-service-box-icon-effect-zoom smue-service-box-basic footer_img">
            <div class="smue-service-box-icon-section smue-service-box-big-image" style=" padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px;">
              <div class="smue-service-box-icon-holder" style=" font-size: 300px;">
                <div style="background-image: url(&#39;{{asset('frontend/assets/images/footer-open-hour-bg.jpg')}}&#39;);"></div>
              </div>
            </div>
            <div class="smue-service-box-data-section">
              <div class="smue-service-box-heading-section">
                <h2 style=" color: ;">Open Hours</h2>
              </div>
              <div class="smue-service-box-content-section">
                <p>{{$schedules->close_day}}</p>
                <h3>{{$schedules->open_day_1}}</h3>
                <p>{{$schedules->first_open_from}} to {{$schedules->first_open_to}}</p>
                <h3>{{$schedules->open_day_2}}</h3>
                <p>{{$schedules->second_open_from}} to {{$schedules->second_open_to}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="sm-span2 smue-clmn  sme-dsbl-margin-left sme-dsbl-margin-right">
          <div class="sm-row-fluid smue-row sme-dsbl-margin-left sme-dsbl-margin-right footer_icons_row">
            <div class="sm-span3 smue-clmn sme-dsbl-margin-left sme-dsbl-margin-right">
              <div class="smue-ce-icon-obj footer_icons smue-ce-icon-shape-none  smue-ce-icon-size-custom  smue-ce-icon-align-center  sme-dsbl-padding-left sme-dsbl-padding-right sme-dsbl-margin-top sme-dsbl-margin-bottom" style=" font-size: 18.000000px;">
                <div style="background-color:transparent; border-color: transparent;" class="smue-ce-icon-bg"><span class="fa fa-facebook-square smue-ce-icon-preview" style="color:rgb(206, 50, 50)"></span></div>
              </div>
            </div>
            <div class="sm-span3 smue-clmn sme-dsbl-margin-left sme-dsbl-margin-right">
              <div class="smue-ce-icon-obj footer_icons smue-ce-icon-shape-none  smue-ce-icon-size-custom  smue-ce-icon-align-center  sme-dsbl-padding-left sme-dsbl-padding-right sme-dsbl-margin-top sme-dsbl-margin-bottom" style=" font-size: 18.000000px;">
                <div style="background-color:transparent; border-color: transparent;" class="smue-ce-icon-bg"><span class="fa fa-twitter smue-ce-icon-preview" style="color:rgb(206, 50, 50)"></span></div>
              </div>
            </div>
            <div class="sm-span3 smue-clmn sme-dsbl-margin-left sme-dsbl-margin-right">
              <div class="smue-ce-icon-obj footer_icons smue-ce-icon-shape-none  smue-ce-icon-size-custom  smue-ce-icon-align-center  sme-dsbl-padding-left sme-dsbl-padding-right sme-dsbl-margin-top sme-dsbl-margin-bottom" style=" font-size: 18.000000px;">
                <div style="background-color:transparent; border-color: transparent;" class="smue-ce-icon-bg"><span class="fa fa-instagram smue-ce-icon-preview" style="color:rgb(206, 50, 50)"></span></div>
              </div>
            </div>
            <div class="sm-span3 smue-clmn sme-dsbl-margin-left sme-dsbl-margin-right">
              <div class="smue-ce-icon-obj footer_icons smue-ce-icon-shape-none  smue-ce-icon-size-custom  smue-ce-icon-align-center  sme-dsbl-padding-left sme-dsbl-padding-right sme-dsbl-margin-top sme-dsbl-margin-bottom" style=" font-size: 18.000000px;">
                <div style="background-color:transparent; border-color: transparent;" class="smue-ce-icon-bg"><span class="fa fa-google smue-ce-icon-preview" style="color:rgb(206, 50, 50)"></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- .site-footer --> </div>
  <!-- .site-inner --> 
</div>
<!-- .site --> 

<script type="text/javascript" src="{{asset('frontend/assets/js/skip-link-focus-fix.js')}}"></script> 
<script type="text/javascript">
/* <![CDATA[ */
var screenReaderText = {"expand":"expand child menu","collapse":"collapse child menu"};
/* ]]> */
</script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/functions.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/szp-embed.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/jquery.stellar.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/jquery.backstretch.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/jquery.waypoints.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/mp-waypoint-animations.js')}}"></script>
<style id="smue-ce-private-styles" data-posts="" type="text/css">
</style>
</body>
</html>