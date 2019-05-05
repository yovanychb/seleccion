function menu() {
    var x = document.getElementById("navbar");
    var y = document.getElementById("out");
    if (x.className === "navbar2") {
      x.className += " responsive";
    } else {
      x.className = "navbar2";
    }
    if (y.className === "out") {
      y.className += " responsive";
    } else {
      y.className = "out";
    }
}

