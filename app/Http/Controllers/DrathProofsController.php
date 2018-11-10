<?php

namespace App\Http\Controllers;

use App\Models\DrathProof;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DrathProofRequest;
use App\Libs\ImageUpload;

class DrathProofsController extends Controller
{
    

	public function index(Request $request)
	{
		$drath_proofs = DrathProof::filter($request->all())->paginate(10);
		$select=$request->except('page');
		return view('drath_proofs.index', compact('drath_proofs','select'));
	}

    public function show(DrathProof $drath_proof)
    {
        return view('drath_proofs.show', compact('drath_proof'));
    }

	public function create(DrathProof $drath_proof)
	{
		return view('drath_proofs.create_and_edit', compact('drath_proof'));
	}

	public function store(ImageUpload $imgage_upload, DrathProofRequest $request)
	{
		
		$post_data=$request->except('images');
		//上传图片
		if($request->images){
			
			$post_data['images']=$imgage_upload->save($request->images,'drath_proofs');
		}
		
		//生成编号
		$post_data['number']=create_number('drath_proofs');
		
		$drath_proof = DrathProof::create($post_data);
		return redirect()->route('drath_proofs.index', $drath_proof->id)->with('message', '添加信息成功');
	}

	public function edit(DrathProof $drath_proof)
	{
        $this->authorize('update', $drath_proof);
		return view('drath_proofs.create_and_edit', compact('drath_proof'));
	}

	public function update(DrathProofRequest $request, DrathProof $drath_proof)
	{
		$this->authorize('update', $drath_proof);
		$drath_proof->update($request->all());

		return redirect()->route('drath_proofs.index', $drath_proof->id)->with('message', 'Updated successfully.');
	}

	public function destroy(DrathProof $drath_proof)
	{
		$this->authorize('destroy', $drath_proof);
		$drath_proof->delete();

		return redirect()->route('drath_proofs.index')->with('message', 'Deleted successfully.');
	}
}