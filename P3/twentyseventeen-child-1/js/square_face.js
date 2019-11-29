last=[0,0,0,0];
fist=true;
function draw(ctxt, coord) {
      if(last[0]<coord.x && last[0]+last[2]>coord.x && last[1]<coord.y && last[1]+            last[3]>coord.y && !first){
       ctxt.fillStyle = "rgb(255,0,240)";
       ctxt.fillRect(last[0], last[1], last[2],last[3]);
      }else{
       
ctxt.fillStyle = "rgb(81,80,84)";
    	size_x=Math.floor(Math.random()*70)+10;
      size_y=Math.floor(Math.random()*70)+10;

			ctxt.fillRect(coord.x, coord.y, size_x,size_y); 
      last=[coord.x, coord.y, size_x,size_y];
      first=false;
      }      
}


function getMousePos(canvas, evt) {
				var rect = canvas.getBoundingClientRect();
				return {
					x: evt.clientX - rect.left,
					y: evt.clientY - rect.top
				};
			}

function start(){ var canvas = document.querySelector("#sketchpad");
			ctxt = canvas.getContext('2d');
			canvas.addEventListener("click",function(evt){
				coord=getMousePos(canvas, evt);
				draw(ctxt, coord) ;
			});
                 
                 canvas.addEventListener("click",function(){
				console.log(canvas.style)
			});
                }


start();
