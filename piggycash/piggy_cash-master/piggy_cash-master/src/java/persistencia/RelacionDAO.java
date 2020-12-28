package persistencia;

import java.util.List;

/*
    INTERGAZ ESPECÍFICA DE LAS TABLAS QUE REPRESENTAN RELACIONES N...n con atributos en la relación
*/

public interface RelacionDAO <E1, E2, A>{
    
    public A getAttribute(E1 elemento1, E2 elemento2); // Dados dos atributos, nos devuelve el atributo de la relación
    
    public List<E1> getElemento1(E2 elemento2); //Dado una instancia de una clase, nos devuelve las instancias de los objetos de la otra clase
    
    public List<E2> getElemento2(E1 elemento1); // Idém pero en sentido opuesto.
}
