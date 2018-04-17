export default function (Vue) {
    Vue.auth = {
        setToken(token, expiration){
            localStorage.setItem('l4m_token', token);
            localStorage.setItem('l4m_expiration', expiration);
        },

        getToken(){
            var token = localStorage.getItem('l4m_token');
            var expiration = localStorage.getItem('l4m_expiration');

            if(!token || !expiration){
                return null;
            }

            if(Date.now() > parseInt(expiration)){
                this.destroyToken();
                return null;
            }else{
                return token;
            }
        },

        destroyToken(){
            localStorage.removeItem('l4m_token');
            localStorage.removeItem('l4m_expiration');
        },

        isAuth(){
            if(this.getToken()){
                return true;
            }else{
                return false;
            }
        }
    }

    Object.defineProperties(Vue.prototype, {
        $auth: {
            get: () => {
                return Vue.auth
            }
        }
    });
}
