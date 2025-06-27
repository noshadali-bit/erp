
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".chart_progress").forEach(chart => {
        let value = parseInt(chart.getAttribute("data"));
        let progressBar = chart.querySelector(".chart_progress_bar");
        
        progressBar.style.width = value + "%";
        progressBar.style.transition = "width 1s ease-in-out";
        

        if (value < 30) {
            progressBar.style.backgroundColor = "#f73164";
        } else if (value < 60) {
            progressBar.style.backgroundColor = "#03a9f4";
        } else {
            progressBar.style.backgroundColor = "#4caf50";
        }
        
        let progressText = document.createElement("span");
        progressText.classList.add("progress_text");
        progressText.textContent = value + "%";
        chart.appendChild(progressText); 
    });
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".rount_chart").forEach(chart => {
        let progressCircle = chart.querySelector(".circle-progress");
        let span = chart.querySelector("span");
        
        let value = parseInt(span.getAttribute("data-progress")); // Value HTML se le rahe hain
        let circumference = 2 * Math.PI * 40;
        let progressValue = ((100 - value) / 100) * circumference;

        // Stroke color logic
        let color = "#f73164"; // Default purple
        if (value < 30) {
            color = "#f73164"; // 30% se kam ho to red
        } else if (value < 60) {
            color = "#03a9f4"; // 60-80 blue
        } else {
            color = "#4caf50"; // 80+ green
        }

        progressCircle.style.strokeDashoffset = progressValue;
        progressCircle.style.stroke = color;

        // 🌟 Individual shadow for each progress color
        progressCircle.style.filter = `drop-shadow(0px 0px 10px 8px ${color})`;
    });
});
 
 

 

 
//  document.querySelectorAll('.dropdown_list').addEventListener('click', function(e){
//      $(e +" > .action").classList.toggle('active')
//         //  document.querySelectorAll('.action').classList.toggle('active')
//          })
//  })