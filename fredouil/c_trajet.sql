create function c_trajet(ville_dep character varying, ville_arr character varying, nb_voyageurs integer, sequence_ville character varying, sequence_id character varying, cumul integer, hd integer)
    returns TABLE(v_dep character varying, v_arr character varying, v_id_voyage character varying)
    language plpgsql
as
$$


declare 
 arrivee_tmp jabaianb.trajet.arrivee%type;
 km_tmp jabaianb.trajet.distance%type;
 c varchar(25);
 i int;
 id_tmp int;
 hd_tmp int;
 
begin
  
 raise notice 'recursif % % % % %', ville_dep, ville_arr, cumul, hd,sequence_ville; 
 
 -- si le voyage en cours dépasse la journée (24h*60mn = 1440), on arrête la recherche sur cette branche
 if(cumul > 1440) then
   return;
 end if;

 for arrivee_tmp, km_tmp, id_tmp, hd_tmp in select arrivee, distance, jabaianb.voyage.id, heuredepart from jabaianb.voyage join jabaianb.trajet on jabaianb.voyage.trajet=jabaianb.trajet.id where (depart=ville_dep) and (arrivee != depart) and position(arrivee in sequence_ville)=0 and (heuredepart >= hd) and (nbplace >= nb_voyageurs) loop
  
  -- test si la recherche récursive du trajet aboutit à la ville d'arrivée
  -- si oui, nous testons si le cumul des temps est bien inférieur à la journée (60mn/km*24h)
  -- si oui => un voyage avec correspondance possible a été trouvé
  -- ce voyage a été stocké pendant la procédure récursive dans sequence_ville et sequence_id
  
  raise notice 'Proposition Voyage => % % % % : % %', sequence_ville || ' ' || arrivee_tmp, cumul, km_tmp, hd_tmp, arrivee_tmp, ville_arr;

  if((arrivee_tmp=ville_arr) and ((cumul+km_tmp) < 1440)) then
   
   raise notice 'Proposition Voyage validée => % % % %', sequence_ville || ' ' || arrivee_tmp, cumul, km_tmp, hd_tmp;
 

   -- il s'agit ici de parcourir la chaine "sequence_id || ' ' || arrivee_tmp" pour renvoyer un enregistrement pour chaque couple ville_dep ville_arrivee trouvé par la commande return NEXT

   i:=1;
   loop
    v_dep:=split_part(sequence_ville || ' ' || arrivee_tmp, ' ', i);
    v_arr := split_part(sequence_ville || ' ' || arrivee_tmp, ' ', i+1);
    v_id_voyage := split_part(sequence_id || ' ' || id_tmp, ' ', i+1);
    exit when v_dep='' or v_arr='';
    raise notice 'split_part v_dep (%): % ', i, v_dep;
    raise notice 'split_part v_arr (%): % ', i+1, v_arr;
    raise notice 'split_part v_dep (%): % ', i, v_id_voyage ;
    i:=i+1;
    return NEXT;
    
   end loop;
   
  -- si les conditions d'arrêt ne sont pas atteintes, on repart dans la récursivité
  else
  
   return QUERY select * from c_trajet(arrivee_tmp,ville_arr, nb_voyageurs, sequence_ville || ' ' || arrivee_tmp, sequence_id || ' ' || id_tmp, cumul+km_tmp, hd_tmp+quelle_heure(km_tmp));
  
  end if;


  
 end loop;
 return;  
end;

$$;

alter function fredouil.c_trajet(varchar, varchar, integer, varchar, varchar, integer, integer) owner to fredouil;

