// ГОРЯЧИЕ КЛАВИШИ, файл hotkeys.js
// Для работы требуется JQuery. Автор: Олег Йожик Дубров

$(function(){
  // Задаем псевдоними для каждой кнопки, создав специальный ассоциативный массив:
  var keyCodes = {D:68, E:69, F:70, M:77, N:78, O:79, U:85, Esc:27, "/":220,
    "0":48, "1":49,  "2":50, "3":51, "4":52, "5":53, "6":54, "7":55, "8":56, "9":57,
    Left:37, Up:38, Right:39, Down:40, Enter:13, Ctrl:17, Alt:18, Space:32
    // прошу простить, тут не все коды клавиш
  };
  
  
    // просто функция, проверяющая массив на предмет существования элемента
  var in_array = function(needle, haystack){
    for (key in haystack)
      if (haystack[key] == needle) return true;
    return false;
  }
  
  
  // Если нажата клавиша на странице
  $("html").keydown(function(e){
    var lastGood = false;
    $("a[hotkey], input[hotkey]").each(function(a){
      var hotkey = $(this).attr("hotkey"); 
      var words = hotkey.split("+");
      var key = words.pop().replace(/\s/,"");
      var syskeys = new Array();
      for(var i in words) syskeys.push(words[i].replace(/\s+/g,""));
      if(keyCodes[key] != e.keyCode) return;
      if(in_array('Ctrl', syskeys)    && !e.ctrlKey) return;
      if(in_array('Alt', syskeys)     && !e.altKey) return; 
      if(in_array('Shift', syskeys)   && !e.shiftKey) return;
      lastGood = $(this);
    });
    if(lastGood){
      if(lastGood.attr("type") == 'submit')
        $(lastGood.context.form).submit();
      else{ 
      }
      return false; 
    }
  }); 
});