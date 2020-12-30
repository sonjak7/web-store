function closeDesc(product){
    document.getElementById(product).style.top = "-100%";
}


function openDesc(product){
    document.getElementById(product).style.top = "2%";
}

//prevent quantity/add-to-cart buttons from opening product description
function noShow(){              
    event.cancelBubble=true;
    if(event.stopPropagation){
        event.stopPropagation();
    }
    return false;
}
