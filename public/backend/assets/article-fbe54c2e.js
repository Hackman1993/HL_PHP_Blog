import{r as e}from"./request-a2427700.js";const a=t=>e("/content/article/create","post",t),n=t=>e(`/content/article/update/${t.article_id}`,"post",t),c=t=>e("/content/article/delete","delete",t),o=t=>e(`/content/article/content/${t.article_id}`,"get"),i=t=>e("/content/art_category","get",t),s=t=>e(`/content/art_category/detail/${t.category_id}`,"get"),g=t=>e("/content/article","get",t),p=t=>e("/content/art_category/list","get",t),l=t=>e("/content/art_category/create","post",t),A=t=>e(`/content/art_category/update/${t.art_category_id}`,"put",t),d=t=>e("/content/art_category/delete","delete",t);export{i as A,o as a,n as b,a as c,s as d,g as e,c as f,l as g,A as h,p as i,d as j};