function menu() {
    var x = document.getElementById("navbar");
    if (x.className === "navbar2") {
      x.className += " responsive";
    } else {
      x.className = "navbar2";
    }
}

