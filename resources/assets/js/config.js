let baseUrl = '';
if(process.env.NODE_ENV === 'production'){
    baseUrl = 'http://l4m.mia.rs/';
}else{
    baseUrl = 'http://localhost/l4m/public/';
}

export const apiHost = baseUrl;