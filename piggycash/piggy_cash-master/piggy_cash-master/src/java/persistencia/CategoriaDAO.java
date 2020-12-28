package persistencia;

import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import pojos.Categoria;

public class CategoriaDAO implements DAO<Categoria, String> {

    private Session sesion = null;

    @Override
    public void create(Categoria elemento) {
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
    public void update(Categoria elemento) {
       
        try {
            
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            
            Query q =  sesion.createQuery("update Categoria set colorBorde = '"+elemento.getColorBorde()+"', colorFondo = '"+elemento.getColorFondo()+"'  where nombre = '"+elemento.getNombre()+"'");
            
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
    public void delete(Categoria elemento) {
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

    /* BORRAMOS UNA CATEGORIA POR SU PK */
    public void delete(String pk) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();

            Query q1 = sesion.createQuery("update Producto set categoria = NULL where categoria.nombre = '"+pk+"'");
            Query q2 = sesion.createQuery("delete from Categoria c  where c.nombre='" + pk + "'");

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
    public Categoria read(String primaryKey) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Categoria where nombre='" + primaryKey + "'");
            tx.commit();
            return (Categoria) query.uniqueResult();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Categoria> list() {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Categoria");
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
    public List<String> listPK() {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        List<String> listaNombres = new ArrayList<>();
        List<Categoria> listaCategorias;
        try {
            tx = sesion.beginTransaction();
            listaCategorias = list();
            for (int i = 0; i < listaCategorias.size(); i++) {
                listaNombres.add(listaCategorias.get(i).getNombre());
            }
            tx.commit();
            return listaNombres;
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

}
