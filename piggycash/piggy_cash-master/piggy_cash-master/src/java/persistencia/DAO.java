package persistencia;

import java.util.List;

public interface DAO <E, PK>{
    
    public void create(E elemento); // Se proporciona un elemento y se guarda íntegro en la base de datos
    public void update(E elemento); // Se proporciona un elemento y se actualiza en la base de datos
    public void delete(E elemento); // Se proporciona un elemento y se borra de la base de datos
    public E read(PK primaryKey); // Se proporciona una PK y se devuelve el objeto
    public List<E> list(); // Se listan todos  los elementos de una clase 
    public List<PK> listPK(); // Se listan todad las PK de todos los elementos de una clase
}
