/* JS for contact.php choose file button */

updateList = function() {
  var input = document.getElementById('file');
  var output = document.getElementById('fileList');

  output.innerHTML = '<ul>';
  for (var i = 0; i < input.files.length; ++i) {
    output.innerHTML += '<ol>' + input.files.item(i).name + '</ol>';
  }
  output.innerHTML += '</ul>';
}
