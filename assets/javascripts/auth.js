const applicationConfig = {
    clientID: 'dbdc3209-3d97-4c1a-9960-f05508e40077',
    graphEndpoint: "https://graph.microsoft.com/beta/me/",
    graphScopes: ["user.read"]
}

const site_url='/archives/';

function loggerCallback(logLevel, message, piiLoggingEnabled) {
    console.log(message);
}

const loginOnPremise = (data) => {
    // autosubmit form
    document.querySelector('#o365').value = JSON.stringify(data)
    document.querySelector('#o365Form').submit()

}
    
let logger = new Msal.Logger(loggerCallback, { level: Msal.LogLevel.Verbose}); 
//Logger has other optional parameters like piiLoggingEnabled which can be assigned as shown aabove. Please refer to the docs to see the full list and their default values.
    
let userAgentApplication = new Msal.UserAgentApplication(applicationConfig.clientID, null, authCallback, { logger: logger, cacheLocation: 'localStorage'}); //logger and cacheLocation are optional parameters.
//userAgentApplication has other optional parameters like redirectUri which can be assigned as shown above.Please refer to the docs to see the full list and their default values.
function authCallback(errorDesc, token, error, tokenType) {
    if (token) {
        this.acquireTokenSilent(applicationConfig.graphScopes).then(function (accessToken) {
            // auth to O365
            fetch('https://graph.microsoft.com/beta/me/',{ 
                headers:{'Authorization':'Bearer '+accessToken}, 
                method: 'GET'}
            ).then(response => response.json()).catch((err) => {
                alert('unable to sign in!')
            }).then(data => {
                // auth to onpremise
                if(data.id) {
                    loginOnPremise(data)
                }
            })
            

        },function (error) {
            console.log(error);
            this.acquireTokenPopup(applicationConfig.graphScopes).then(function (accessToken) {
                console.log(this.getUser())
            }, function (error) {
                console.log(error);
            });
        })
    } else {
        log(error + ":" + errorDesc);
    }
}



const loginRedirect = (el) => { 
    el.disabled = 'disabled'
    userAgentApplication.loginRedirect(applicationConfig.graphScopes);
}

document.addEventListener('DOMContentLoaded', () => {
   document.querySelector('.go-to-app-btn').addEventListener('click', (e) => {
        e.target.disabled = 'disabled'
        loginRedirect(this)
   })
})