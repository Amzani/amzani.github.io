//main try dailymotion api module
trydmapi = {};

trydmapi.sucessHook  = null;
trydmapi.currentPage = null;
trydmapi.stdout      = [];
trydmapi.stdin		 = [];
trydmapi.io        = null;
trydmapi.levels = {}

trydmapi.levels.list = 
[
    {
        level:0,
        title : 'Got 5 minutes',
        content: 'Content level 0',
    },
    {
        level:1,
        title : 'Level 1',
        content: 'Content level 1',
    },
    {
        level:2,
        title : 'Level 2',
        content: 'Content level 2',
    },
];

//prevent the command from being run if
trydmapi.cliHook = function(line, report){
    var input;
    var pages = trydmapi.levels.list;

    if (line.trim() == 'go') {
        trydmapi.setLevel(1, null);
        report();
        return true;
    }

    return false;
}

//set current level
trydmapi.setLevel = function(n, result) {
    var level = trydmapi.levels.list[n];
    if (level) {
        console.log("setLevel " + n);

        var guidDom = $('#guid');
        guidDom.html(level.content);
        if (trydmapi.currentPage != null) {
            window.location = '/#level' + (n + 1);
            }
        trydmapi.currentPage = n;
        var nextLevel = trydmapi.levels.list[n+1];
        if (nextLevel) {
            trydmapi.sucessHook = function(result) {
                console.log("sucessHook");
            };
        }
    } else{
        throw "Unknown page number: " + n;
        }
}

trydmapi.callCommand = function(line, report, stdin){
    console.log(line);
    trydmapi.stdout = line;
    trydmapi.io = line;
    DM.api('/videos', {limit:3}, function(response) {
        trydmapi.controller.continuedPrompt = true;
        report(trydmapi.prettyjson(JSON.stringify(response, undefined, 2)));
        trydmapi.controller.continuedPrompt = false;
    });
    
}

trydmapi.prettyjson = function(json) {
    return json;
    if (typeof json != 'string') {
         json = JSON.stringify(json, undefined, 2);
    }
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

//Make the console
trydmapi.makeConsole = function() {
        trydmapi.controller = $('.curl-console').console({
            promptLabel: 'API> ',
            commandValidate:function(line){
                if (line == "") return false;
                else return true;
            },
        
            commandHandle:function(line, report){
                if (trydmapi.io === null) {
                    if (!trydmapi.cliHook(line, report)){
                        console.log("api call");
                        trydmapi.callCommand(line, report, []);
                    }
                } else {
                    trydmapi.stdin.push(line);
                    trydmapi.callCommand(line);
                }
            },
        autofocus: true,
        animateScroll:true,
        promptHistory:true,
        welcomeMessage:'Enter some API expressions to evaluate.',
        continuedPromptLabel: '> '
        });
};

trydmapi.makeGuidSamplesClickable = function() {
    console.log('make Guid');
    $('#guid code').each(function(){
        console.log("call");
        $(this).css('cursor','pointer');
        $(this).attr('title','Click me to insert "' +
                     $(this).text() + '" into the console.');
        $(this).click(function(){
            trydmapi.controller.promptText($(this).text());
            trydmapi.controller.inner.click();
        });
    });
}


$(function() {
	trydmapi.makeConsole();
    trydmapi.makeGuidSamplesClickable();
});