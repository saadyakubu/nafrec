/*function convertMenuBars(x) {
            x.classList.toggle("change");
}*/
var toggleIndex = 0; //keeps tabs on when the menu icon is pressed

/* Animate the three bars mobile nav icon  and Open the overlay menu content when clicked */
function toggleOverlayNavigation(x) 
{
    //get the menuBar icon and replace the menuBar with the cancel Btn
    if(toggleIndex == 0)
    {
        document.getElementById("menuBarX").className = "glyphicon glyphicon-remove";
        document.getElementById("myNav").style.width = "100%";
        document.getElementById("myNav").style.left = "0";
        toggleIndex = 1;
    }
    /* Close the overlay menu when user clicks on the "x" symbol*/
    else if(toggleIndex ==1)
    {
        document.getElementById("menuBarX").className = "glyphicon glyphicon-menu-hamburger";
        document.getElementById("myNav").style.width = "0";
        document.getElementById("myNav").style.left = "100%";
        toggleIndex = 0;
    }
             
}
