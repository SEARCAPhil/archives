
const site_url='/archives/'
const site_host='http://localhost'

// adal
window.config  = {
    instance: 'https://login.microsoftonline.com/', 
    tenant: 'common', //COMMON OR YOUR TENANT ID
    clientId: 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', //This is your client ID
    redirectUri: `${site_host}${site_url}`, //This is your redirect URI
    cacheLocation: 'localStorage',
    callback: userSignedIn,
    popUp: true,
    endpoints : {"https://graph.microsoft.com": "https://graph.microsoft.com"},
}

// adal error
const authError = () => {
    alert('unable to sign in!')
}

// get msgraph
const getGraph = (token)  => {
    fetch('https://graph.microsoft.com/beta/me/',{ 
        headers:{'Authorization':'Bearer '+token}, 
        method: 'GET'}
    ).then(response => response.json()).catch((err) => {
        authError()
    }).then(data => {
        // auth to onpremise
        if(data.id) {
            loginOnPremise(data)
        }
    })
}
// authenticate to remote server
const loginOnPremise = (data) => {
    // autosubmit form
    document.querySelector('#o365').value = JSON.stringify(data)
    document.querySelector('#o365Form').submit()

}
// adal callback
function userSignedIn(err, token) {
    if (!err) {
        window.ADAL.acquireToken("https://graph.microsoft.com", function (error, token) {
            
            if(token.length) {
                getGraph(token)
            } else {
                authError()
            }
           
        })
    } else {
       
    }
}

window.ADAL = new AuthenticationContext(window.config);
window.ADAL.handleWindowCallback()

document.addEventListener('DOMContentLoaded', () => {
   document.querySelector('.go-to-app-btn').addEventListener('click', (e) => {
        e.target.disabled = 'disabled'
        window.ADAL.login()
       // window.location = 'https://login.microsoftonline.com/searca.org/oauth2/v2.0/authorize?response_type=code&scope=user.read%20openid%20profile%20openid%20offline_access&client_id=809dddaa-87fe-4a88-abf5-df6621d7c51e&redirect_uri=http://localhost/archives/&state=422e8f20-ffaa-4fd9-a86d-8112931e4527&nonce=4dd87765-55b6-4d29-95c8-bcf6bf174b3a&client_info=1&x-client-SKU=MSAL.JS&x-client-Ver=0.1.6&prompt=select_account&response_mode=query'
   })
})