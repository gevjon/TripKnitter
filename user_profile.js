ExecuteOrDelayUntilScriptLoaded(init,'sp.js');
var currentUser;
function init(){
    this.clientContext = new SP.ClientContext.get_current();
    this.oWeb = clientContext.get_web();
    currentUser = this.oWeb.get_currentUser();
    this.clientContext.load(currentUser);
    this.clientContext.executeQueryAsync(Function.createDelegate(this,this.onQuerySucceeded), Function.createDelegate(this,this.onQueryFailed));
}

function onQuerySucceeded() {
    document.getElementById('username').innerHTML = currentUser.get_loginName();
    document.getElementById('UID').innerHTML = currentUser.get_id();
    document.getElementById('userTitle').innerHTML = currentUser.get_title();
    document.getElementById('userEmail').innerHTML = currentUser.get_email();
}

function onQueryFailed(sender, args) {
    alert('Request failed. \nError: ' + args.get_message() + '\nStackTrace: ' + args.get_stackTrace());
}
