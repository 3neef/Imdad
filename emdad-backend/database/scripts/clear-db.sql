delete FROM emdad.user_warehouse where id>0;
delete FROM emdad.warehouses where id>0;
delete FROM emdad.product_profile where id>0;
delete from products where profile_id>0;
delete from categories where profile_id>0;
delete FROM emdad.profile_role_user where id>0;
delete FROM emdad.users where id>0;
delete FROM emdad.profiles where id>0;
