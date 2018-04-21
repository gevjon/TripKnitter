<div id="footer" style="background-color:black;color:white;height:18%;clear:both;">
  <p style="padding-left: 200px;padding-right:200px;padding-top: 20px;font-size:10px;">
    About us: TripKnitter provides web based services to plan out
    the trip for you automatically. We knit the plans by searching
    and organizing all spots you either you interested or suits your
     plan. Future function like accommodation and  transportation
    suggestions will be provided.</p>
    <p style="text-align: center;font-size:10px;padding-bottom:10px;">Email: TripKnitter@gmail.com</p>
</div>

<script >
var div = $("#footer");
var space = jQuery(window).height() - (div.offset().top + div.outerHeight());
  div.css("margin-top",space);
</script>

<!-- click Animation -->
<script type="text/javascript">

const burst = new mojs.Burst({
  left: 0, top: 0,
  radius:   { 0: 100 },
  count:    5,
  children: {
    shape:        'circle',
    radius:       10,
    fill:       [ 'pink', 'cyan', 'yellow','yellowgreen','gold' ],
    strokeWidth:  5,
    duration:     2000
  }
});

document.addEventListener( 'click', function (e) {
  burst
    .tune({ x: e.pageX, y: e.pageY })
    .setSpeed(3)
    .replay();
} );

// const bubbles = new mojs.Burst({
//   left: 0, top: 0,
//   radius:   25,
//   count:    3,
//   children: {
//     stroke:       'white',
//     fill:         'none',
//     scale:        1,
//     strokeWidth:  { 8: 0 },
//     radius:       { 0 : 'rand(8, 12)' },
//     degreeShift:  'rand(-50, 50)',
//     duration:     400,
//     delay:        'rand(0, 250)',
//   }
// });
//
// document.addEventListener( 'click', function (e) {
//   bubbles
//     .tune({ x: e.pageX, y: e.pageY })
//     .generate()
//     .replay();
// });
</script>
</body>
</html>
