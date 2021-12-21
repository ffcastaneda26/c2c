(()=>{
    var __webpack_exports__={};
    function loadDealermadeNextHdViewer(){
        const trickWebpackRequire=m=>eval("require")(m);

        function loadScript(e){
            var r=document.createElement("script");
            r.type="text/javascript",
            r.src=e,
            document.body.appendChild(r)
        }

        var parsedDeveloperModeItem=JSON.parse(localStorage.getItem("dealermade-developer-mode")),
            developerMode=!1;

        if(parsedDeveloperModeItem&&parsedDeveloperModeItem.expiry)
            try{
                var expirationDate=new Date(parsedDeveloperModeItem.expiry),
                now=new Date;
                now.getTime()<expirationDate.getTime()&&(developerMode=!!parsedDeveloperModeItem.value)
            }catch(e){
                console.error("Error parsing developer mode storage item.")
            }
            var params={
                    websiteDomain:window.location.host,
                    randomInt:(new Date).getTime(),
                    developerMode
                },
                esc=encodeURIComponent,
                queryString=Object.keys(params).map((function(e){
                    return esc(e)+"="+esc(params[e])}))
                    .join("&");
            let hdViewerToLoadUrl="https://api.dealermade-next.com/v4/system-services/dm-next-hd-viewer";
            "object"==typeof window&&"string"==typeof window.dmNextHdViewerOverrideUrl&&(hdViewerToLoadUrl=window.dmNextHdViewerOverrideUrl),
            loadScript(`${hdViewerToLoadUrl}?${queryString}`)
    }
    loadDealermadeNextHdViewer()
})
();
