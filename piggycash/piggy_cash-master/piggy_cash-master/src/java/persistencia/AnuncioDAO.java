package persistencia;

import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import pojos.Anuncio;

public class AnuncioDAO implements DAO<Anuncio, Integer>{
    
    private Session sesion = null;

    @Override
    public void create(Anuncio elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
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
    public void update(Anuncio elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            sesion.update(elemento);
            tx.commit();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
    }

    @Override
    public void delete(Anuncio elemento) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
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
    
    /*BORRAR ANUNCIO POR SU PK*/
    public void delete(String pk) {
        try {
            sesion = HibernateUtil.getSessionFactory().openSession();
        } catch (HibernateException e) {
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();

            Query q = sesion.createQuery("delete from Anuncio a  where a.id='" + pk + "'");

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
    public Anuncio read(Integer primaryKey) {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Anuncio where id='"+primaryKey+"'");
            tx.commit();
            return (Anuncio) query.uniqueResult();
        } catch (HibernateException e) {
            if (tx != null) {
                tx.rollback();
            }
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Anuncio> list() {
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        try {
            tx = sesion.beginTransaction();
            Query query = sesion.createQuery("from Anuncio");
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
        try{
            sesion = HibernateUtil.getSessionFactory().openSession();
        }catch(HibernateException e){
            sesion = HibernateUtil.getSessionFactory().getCurrentSession();
        }
        Transaction tx = null;
        List<Integer> listaNombres = new ArrayList<>();
        List<Anuncio> listaAnuncios;
        try {
            tx = sesion.beginTransaction();
            listaAnuncios = list();
            for(int i = 0; i < listaAnuncios.size(); i++){
                listaNombres.add(listaAnuncios.get(i).getId());
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
