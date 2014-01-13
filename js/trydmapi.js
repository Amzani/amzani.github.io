//main try dailymotion api module
trydmapi = {};

trydmapi.sucessHook  = null;
trydmapi.currentPage = null;
trydmapi.stdout      = [];
trydmapi.stdin		 = [];
trydmapi.io        = null;


//Make the console
trydmapi.makeConsole = function() {
        trydmapi.controller = $('.curl-console').console({
            promptLabel: 'Curl> ',
            commandValidate:function(line){
                if (line == "") return false;
                else return true;
            },
        
            commandHandle:function(line){
                try { var ret = eval(line);
                if (typeof ret != 'undefined') return ret.toString();
                else return true; }
                catch (e) { return e.toString(); 
            }
        },
        autofocus: true,
        animateScroll:true,
        promptHistory:true,
        welcomeMessage:'Enter some Curl expressions to evaluate.',
        continuedPromptLabel: '> '
        });
};


$(function() {
	trydmapi.makeConsole();
});