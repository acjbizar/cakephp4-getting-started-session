<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CampaignsMailingLists Model
 *
 * @property \App\Model\Table\CampaignsTable&\Cake\ORM\Association\BelongsTo $Campaigns
 * @property \App\Model\Table\MailingListsTable&\Cake\ORM\Association\BelongsTo $MailingLists
 *
 * @method \App\Model\Entity\CampaignsMailingList get($primaryKey, $options = [])
 * @method \App\Model\Entity\CampaignsMailingList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CampaignsMailingList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CampaignsMailingList|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CampaignsMailingList saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CampaignsMailingList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CampaignsMailingList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CampaignsMailingList findOrCreate($search, callable $callback = null, $options = [])
 */
class CampaignsMailingListsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('campaigns_mailing_lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Campaigns', [
            'foreignKey' => 'campaign_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('MailingLists', [
            'foreignKey' => 'mailing_list_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['campaign_id'], 'Campaigns'));
        $rules->add($rules->existsIn(['mailing_list_id'], 'MailingLists'));

        return $rules;
    }
}
