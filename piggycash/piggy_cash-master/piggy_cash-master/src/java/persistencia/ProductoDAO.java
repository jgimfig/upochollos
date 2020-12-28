package persistencia;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import pojos.Producto;

public class ProductoDAO implements DAO<Producto, Integer> {

    private Session sesion = null;

    @Override
    public void create(Producto elemento) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.save(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void update(Producto elemento) {

        try {

            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();

            Query q = sesion.createQuery("update Producto set "
                    + "nombre='" + elemento.getNombre() + "'"
                    + ", enlace='" + elemento.getEnlace() + "'"
                    + ", fechaVencimiento='" + new SimpleDateFormat("yyyy-MM-dd").format(elemento.getFechaVencimiento()) + "'"
                    + ", precioOriginal='" + elemento.getPrecioOriginal() + "'"
                    + ", precioDescuento='" + elemento.getPrecioDescuento() + "'"
                    + ", descripcion='" + elemento.getDescripcion() + "'"
                    + ", imagen='" + elemento.getImagen() + "'"
                    + "  where id = '" + elemento.getId() + "'");

            q.executeUpdate();

            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void delete(Producto elemento) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.delete(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    
    /*DADO UNA PK, BORRA EL ELEMENTO*/
    public void delete(String pk) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();

            Query q1 = sesion.createQuery("delete from Comentario com where com.producto.id = '" + pk + "'");
            Query q2 = sesion.createQuery("delete from Producto p  where p.id='" + pk + "'");

            q1.executeUpdate();
            q2.executeUpdate();

            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public Producto read(Integer primaryKey) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Producto where id='" + primaryKey + "'");
            tx.commit();
            return (Producto) query.uniqueResult();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }

        return null;
    }

    @Override
    public List<Producto> list() {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Producto p WHERE p.fechaVencimiento > current_date()");
            tx.commit();
            return query.list();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Integer> listPK() {
        List<Integer> listaNombres = new ArrayList<>();
        List<Producto> listaProductos;

        listaProductos = list();
        for (int i = 0; i < listaProductos.size(); i++) {
            listaNombres.add(listaProductos.get(i).getId());
        }

        return listaNombres;
    }

    /*MÉTODO NECESARIO PARA LA CARGA PROGRESIVA DE LOS CHOLLOS, SE LE PROPORCIONA:
        - INIDICE DESDE EL QUE EMPEZAR
        - ITEMS A CARGAR
        - LA CATEGORÍA EN EL CASO DE QUE ESTEMOS VIENDO LOS PRODUCTOS POR CATEGROÍAS
          SI NO SE LE PROPORCIONA, DEVUELVE TODOS LOS PRODUCTOS.
    */
    public List<Producto> list(int start, int itemsToLoad, String categoria) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query;
            
            if (categoria == null){
                 query = sesion.createQuery("from Producto p WHERE p.fechaVencimiento > current_date()");
            } else if (categoria.length() == 0){
                query = sesion.createQuery("from Producto p WHERE p.fechaVencimiento > current_date()");
            } else{
               query = sesion.createQuery("from Producto p WHERE p.fechaVencimiento > current_date() and p.categoria.nombre='"+categoria+"'");
            }
            
            tx.commit();

            query.setFirstResult(start);
            query.setMaxResults(itemsToLoad);

            return query.list();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    public List<Integer> listPK(int start, int itemsToLoad, String categoria) {
        List<Integer> listaNombres = new ArrayList<>();
        List<Producto> listaProductos;

        listaProductos = list(start, itemsToLoad, categoria);
        for (int i = 0; i < listaProductos.size(); i++) {

            
                listaNombres.add(listaProductos.get(i).getId());
            

        }

        return listaNombres;
    }

}
